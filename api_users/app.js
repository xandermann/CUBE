const express = require("express");
const User = require("./utils/User");
const bodyParser = require("body-parser");
const mysql = require("mysql");

const AuthentificationException = require("./exceptions/AuthentificationException");
const PageExpiredException = require("./exceptions/PageExpiredException");
const PageNotFound = require("./exceptions/PageNotFoundException");

const app = express();
const port = 3000;

const handler = (fn) =>
  function asyncUtilWrap(...args) {
    const fnReturn = fn(...args);
    const next = args[args.length - 1];
    return Promise.resolve(fnReturn).catch(next);
  };

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

const isAuthMiddleware = require("./middlewares/isAuthMiddleware");
const hasPermissionMiddleware = require("./middlewares/hasPermissionMiddleware");
const { connection } = require("./utils/DBConnection");
const { JsonWebTokenError } = require("jsonwebtoken");

const allowMicroServiceCors = (req, res, next) => {
  // res.header("Access-Control-Allow-Origin", "*");
  // res.header("Access-Control-Allow-Headers", "Accept, Content-Type");
  // res.header("Access-Control-Allow-Headers", "*");
  // console.log("hi");
  next();
};

// --------------------------
// API

app.get(
  "/users",
  handler(async (req, res) => {
    res.json(await User.index());
  })
);

app.post(
  "/users",
  isAuthMiddleware,
  handler(async (req, res) => {
    res.json(await User.store(req.body));
  })
);

app.get(
  "/users/:uuid",
  handler(async (req, res) => {
    res.json(await User.show(req.params.uuid));
  })
);

app.put(
  "/users/:uuid",
  hasPermissionMiddleware,
  handler(async (req, res) => {
    res.json(await User.update(req.params.uuid, req.body));
  })
);

app.delete(
  "/users/:uuid",
  hasPermissionMiddleware,
  handler(async (req, res) => {
    res.json(await User.destroy(req.params.uuid));
  })
);

// --------------------------
// CONNEXION

app.post(
  "/users/signin",
  handler(async (req, res) => {
    res.json(await User.signin(req.body));
  })
);

app.post(
  "/users/lost-password",
  handler(async (req, res) => {
    res.json(await User.lostPassword(req.body));
  })
);

app.post(
  "/users/new-password",
  isAuthMiddleware,
  handler(async (req, res) => {
    res.json(
      await User.newPassword({
        token: req.query.token,
        password: req.body.password,
      })
    );
  })
);

app.post(
  "/users/verify",
  [isAuthMiddleware, allowMicroServiceCors],
  handler(async (req, res) => {
    res.json(await User.verify(req.body));
  })
);

app.post(
  "/users/extend",
  isAuthMiddleware,
  handler(async (req, res) => {
    res.json(await User.extend(req.body));
  })
);

// --------------------------

app.use((err, req, res, next) => {
  if (err instanceof TypeError) {
    res.status(422).json({ error: "input" });
  } else if (
    err instanceof AuthentificationException ||
    err instanceof JsonWebTokenError
  ) {
    res.status(403).json({ error: "auth" });
  } else if (err instanceof PageExpiredException) {
    res.status(419).json({ error: "expired" });
  } else if (err instanceof PageNotFound) {
    res.status(404).json({ error: "not found" });
  } else {
    res.status(500).send("ERROR");
  }

  if (err) {
    console.log(err);
  }
});

app.listen(port, () => {
  console.log(`Listening at http://localhost:${port}`);
});
