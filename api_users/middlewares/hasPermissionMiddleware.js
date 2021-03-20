const jwt = require("jsonwebtoken");
const AuthentificationException = require("../exceptions/AuthentificationException");

/**
 * Verify the jwt token
 * @param {*} req
 * @param {*} res
 * @param {*} next
 */
module.exports = (req, res, next) => {
  if (req.body.token) {
    const { uuid, role } = jwt.verify(req.body.req, process.env.JWT_SIGNATURE);

    if (role !== "admin" || uuid !== req.body.uuid) {
      throw new AuthentificationException();
    }
  }
  next();
};
