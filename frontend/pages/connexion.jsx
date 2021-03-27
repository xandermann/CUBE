import axios from "axios";
import { useState } from "react";

export default function Connexion() {
  const [ok, setOk] = useState(false);

  const onConnect = (e) => {
    e.preventDefault();

    function auth() {
      axios
        .get("http://localhost/sanctum/csrf-cookie", {
          withCredentials: true,
        })
        .then(console.log)
        .then(() => setOk(true));
    }

    auth();
  };

  return (
    <>
      <h1>Connexion</h1>
      <button onClick={onConnect}>Connexion</button>

      {ok && <div className="alert alert-success">OK</div>}
    </>
  );
}
