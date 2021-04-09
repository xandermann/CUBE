import axios from "axios";
import Cookie from "js-cookie";

export default function Connexion() {
  axios.defaults.withCredentials = true;

  axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

  const getToken = (e) => {
    e.preventDefault();

    function auth() {
      axios
        .get("http://localhost/sanctum/csrf-cookie", {
          withCredentials: true,
        })
        .then((response) => console.log(response));
    }

    auth();
  };

  const login = () => {
    console.log("login");

    axios
      .post(
        "http://localhost/login",
        {
          email: "a@a.a",
          password: "a",
        },
        {
          headers: {
            "X-XSRF-TOKEN": Cookie.get("XSRF-TOKEN"),
          },
        }
      )
      .then(console.log)
      .catch(console.error);
  };

  const ping = () => {
    axios
      .get(
        "http://localhost/api/user",
        {},
        {
          headers: {
            "X-XSRF-TOKEN": Cookie.get("XSRF-TOKEN"),
          },
        }
      )
      .then(console.log)
      .catch(console.log);
  };

  const logout = () => {
    console.log("logout");

    axios
      .post(
        "http://localhost/logout",
        {},
        {
          headers: {
            "X-XSRF-TOKEN": Cookie.get("XSRF-TOKEN"),
          },
        }
      )
      .then(console.log)
      .catch(console.log);
  };

  return (
    <div className="text-center">
      <h1>Connexion</h1>
      <button onClick={getToken}>GetToken</button>
      <button onClick={login}>Login</button>
      <button onClick={ping}>Ping api user</button>
      <button onClick={logout}>Logout</button>
    </div>
  );
}
