import axios from "axios";
import Link from "next/link";
import { useRouter } from "next/router";
import { useContext } from "react";
import { AuthContext } from "../pages/_app";

export function Navbar() {
  const router = useRouter();
  const [{ id, firstname, lastname }, setAuth] = useContext(AuthContext);

  const handleLogout = () => {
    axios
      .post("http://localhost/logout")
      .then(() => setAuth(false))
      .then(() => router.push("/"))
      .catch(console.log("erreur logout"));
  };

  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-light">
      <div className="container-fluid">
        <Link href="/">
          <a className="navbar-brand">GoodFood</a>
        </Link>
        <button
          className="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarSupportedContent">
          <ul className="navbar-nav me-auto mb-2 mb-lg-0">
            <li className="nav-item">
              <Link href="/">
                <a className="nav-link active" aria-current="page" href="#">
                  Accueil
                </a>
              </Link>
            </li>
            <li className="nav-item">
              <Link href="/restaurants">
                <a className="nav-link">Liste des restaurants</a>
              </Link>
            </li>
          </ul>

          {!id ? (
            <form className="d-flex">
              <Link href="/connexion">
                <a className="btn btn-primary">Connexion</a>
              </Link>
              <Link href="/inscription">
                <a className="btn btn-outline-primary">Inscription</a>
              </Link>
            </form>
          ) : (
            <>
              <Link href="/profile">
                <a className="btn btn-primary">
                  {firstname} {lastname}
                </a>
              </Link>
              <Link href="">
                <div className="btn btn-secondary" onClick={handleLogout}>
                  Se déconnecter
                </div>
              </Link>
            </>
          )}
        </div>
      </div>
    </nav>
  );
}
