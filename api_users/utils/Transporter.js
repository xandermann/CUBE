const nodemailer = require("nodemailer");

let transporter = nodemailer.createTransport({
  host: process.env.MAIL_HOST,
  port: 25,
  secure: false,
  tls: {
    rejectUnauthorized: false,
  },
});

module.exports = transporter;
