import axios from "axios";
import { useRouter } from "next/router";
import { useContext, useState } from "react";
import { AuthContext } from "./_app";

export default function Connexion() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState(false);
  const router = useRouter();
  const [auth, setAuth] = useContext(AuthContext);

  const handleSubmit = (e) => {
    e.preventDefault();

    async function f() {
      const tokenResponse = await axios.get(
        "http://localhost/sanctum/csrf-cookie"
      );

      try {
        const token = await axios.post("http://localhost/login", {
          email,
          password,
        });
      } catch (e) {
        return setError(true);
      }

      axios
        .get("http://localhost/api/user")
        .then((response) => response.data)
        .then(setAuth);

      router.push("/");
    }

    f();
  };

  return (
    <main className="form-signin" style={style}>
      {error && (
        <div
          className="alert alert-danger alert-dismissible fade show"
          role="alert"
        >
          <strong>Erreur:</strong> Identifiants incorrects
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
          ></button>
        </div>
      )}

      <form onSubmit={handleSubmit}>
        <h1 className="h3 mb-3 fw-normal">Connexion</h1>

        <div className="form-floating">
          <input
            type="email"
            className="form-control"
            id="floatingInput"
            placeholder="name@example.com"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          />
          <label htmlFor="floatingInput">Adresse email</label>
        </div>
        <div className="form-floating">
          <input
            type="password"
            className="form-control"
            id="floatingPassword"
            placeholder="Password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
          <label htmlFor="floatingPassword">Mot de passe</label>
        </div>

        <button className="w-100 btn btn-lg btn-primary" type="submit">
          Connexion
        </button>
      </form>
    </main>
  );
}

const style = {
  width: "100%",
  maxWidth: "330px",
  padding: "15px",
  margin: "0 auto",
};
