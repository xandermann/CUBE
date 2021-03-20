const jwt = require("jsonwebtoken");

/**
 * Verify the jwt token
 * @param {*} req
 * @param {*} res
 * @param {*} next
 */
module.exports = (req, res, next) => {
  if (req.body.token) {
    jwt.verify(req.body.token, process.env.JWT_SIGNATURE);
  }
  next();
};
