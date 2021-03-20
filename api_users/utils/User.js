const mysql = require("mysql");
const { querySync } = require("./DBConnection");
const validator = require("validator");
const { v4: uuid } = require("uuid");
const bcrypt = require("bcryptjs");
const jwt = require("jsonwebtoken");
const transporter = require("./Transporter");

const AuthentificationException = require("./../exceptions/AuthentificationException");
const PageExpiredException = require("./../exceptions/PageExpiredException");
const PageNotFoundException = require("../exceptions/PageNotFoundException");
const axios = require("axios");

module.exports = class User {
  static async index() {
    return await querySync("SELECT uuid, firstname, lastname FROM users");
  }

  static async store({
    firstname,
    lastname,
    gender,
    email,
    authorized,
    role,
    password,
  }) {
    validator.isLength(firstname, { min: 2, max: 32 });
    validator.isLength(lastname, { min: 2, max: 32 });
    validator.isIn(gender, ["male", "female"]);
    validator.isEmail(email);
    validator.isInt(authorized, [0, 1]);
    validator.isIn(role, ["admin", "player"]);
    validator.isStrongPassword(password, { minLength: 2 });

    const salt = bcrypt.genSaltSync(10);
    const hash = bcrypt.hashSync(password, salt);

    const query = mysql.format(
      "INSERT INTO `users` (`uuid`, `firstname`, `lastname`, `gender`, `email`, `authorized`, `role`, `password`) VALUES (?, ?, ?, ?, ?,	?,	?,	?);",
      [uuid(), firstname, lastname, gender, email, authorized, role, hash]
    );

    await querySync(query);

    return true;
  }

  static async show(uuid) {
    const query = mysql.format(
      "SELECT uuid, firstname, lastname FROM users WHERE uuid = ?",
      [uuid]
    );

    const [result] = await querySync(query);

    if (!result) {
      throw new PageNotFoundException();
    }

    return await querySync(query);
  }

  static async update(
    uuid,
    { firstname, lastname, gender, email, authorized, role, password }
  ) {
    validator.isLength(uuid, { min: 2, max: 32 });
    validator.isLength(firstname, { min: 2, max: 32 });
    validator.isLength(lastname, { min: 2, max: 32 });
    validator.isIn(gender, ["male", "female"]);
    validator.isEmail(email);
    validator.isInt(authorized, [0, 1]);
    validator.isIn(role, ["admin", "player"]);
    validator.isStrongPassword(password, { minLength: 2 });

    const salt = bcrypt.genSaltSync(10);
    const hash = bcrypt.hashSync(password, salt);

    const query = mysql.format(
      "UPDATE `users` SET `firstname` = ?, `lastname` = ?, `gender` = ?, `email` = ?, `authorized` = ?, `role` = ?, `password` = ? WHERE `uuid` = ?",
      [firstname, lastname, gender, email, authorized, role, hash, uuid]
    );

    await querySync(query);

    return true;
  }

  static async destroy(uuid) {
    validator.isUUID(uuid);

    const query = mysql.format("DELETE FROM users WHERE uuid = ?", [
      req.params.uuid,
    ]);

    await querySync(query);

    return true;
  }

  static async signin({ email, password }) {
    validator.isEmail(email);

    const query = mysql.format(
      "SELECT uuid, password, authorized FROM users WHERE email = ?",
      [email]
    );

    const [result] = await querySync(query);

    if (!result) {
      throw new AuthentificationException();
    }

    await new Promise((resolve, reject) => {
      bcrypt.compare(password, result.password, (err, res) => {
        if (err || !res) reject(false);
        else resolve(true);
      });
    }).catch((err) => {
      throw new AuthentificationException();
    });

    const { uuid, authorized } = result;

    const token = jwt.sign({ uuid, authorized }, process.env.JWT_SIGNATURE);

    return { token };
  }

  static async lostPassword({ email }) {
    const query = mysql.format(
      "SELECT uuid, email FROM users WHERE email = ?",
      [email]
    );

    const [result] = await querySync(query);

    if (!result) {
      throw new AuthentificationException();
    }

    const { uuid } = result;

    const token = jwt.sign({ uuid }, process.env.JWT_SIGNATURE);
    const resetLink = `${process.env.REACT_APP_URL_API_USERS}/users/new-password?token=${token}`;

    await axios.post("http://api_mail:3000", {
      from: "Super@Game.com",
      to: result.email,
      subject: "Mot de passe oublie",
      html: `<div style="width: 40%; word-wrap: break-word;">${resetLink}</div>`,
    });

    return true;
  }

  static async newPassword({ token, password }) {
    const { uuid, iat } = jwt.verify(token, process.env.JWT_SIGNATURE);
    validator.isStrongPassword(password, { minLength: 2 });

    const old = Date.now() / 1000 - iat;

    if (old > 60 * 60) {
      throw new PageExpiredException();
    }

    const salt = bcrypt.genSaltSync(10);
    const hash = bcrypt.hashSync(password, salt);

    const query = mysql.format(
      "UPDATE `users` SET `password` = ? WHERE uuid = ?",
      [hash, uuid]
    );

    console.log("&&&&&&&&&&&", hash, uuid, iat);

    await querySync(query);

    return true;
  }

  static async verify() {
    return true;
  }

  static async extend({ token }) {
    const oldToken = jwt.verify(token, process.env.JWT_SIGNATURE);

    const { iat, ...tokenContent } = oldToken;

    const newToken = jwt.sign({ ...tokenContent }, process.env.JWT_SIGNATURE);

    console.log("newwww", newToken);

    return { newToken };
  }
};
