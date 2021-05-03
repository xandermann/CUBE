// import '../styles/globals.css'
import axios from "axios";
import "bootstrap/dist/css/bootstrap.min.css";
import Cookie from "js-cookie";
import Head from "next/head";
import React, { useEffect, useState } from "react";
import { Navbar } from "../components/Navbar";

export const AuthContext = React.createContext(null);
axios.defaults.withCredentials = true;
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

function MyApp({ Component, pageProps }) {
  const [auth, setAuth] = useState(false);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    async function f() {
      if (!Cookie.get("XSRF-TOKEN")) {
        const tokenResponse = await axios
          .get(`${process.env.NEXT_PUBLIC_API_URL}/sanctum/csrf-cookie`)
          .catch(console.log);
      }
    }
    f();
  }, []);

  useEffect(() => {
    axios
      .get(`${process.env.NEXT_PUBLIC_API_URL}/api/user`)
      .then((response) => response.data)
      .then(setAuth)
      .then(() => console.log("authentifié"))
      .catch(() => console.log("Pas authentifié"))
      .then(() => setLoading(false));
  }, []);

  return (
    <>
      {loading ? (
        <>Chargement...</>
      ) : (
        <>
          <Head>
            <meta
              name="viewport"
              content="width=device-width, initial-scale=1"
            />
            <title>Good Food</title>
          </Head>

          <AuthContext.Provider value={[auth, setAuth]}>
            <Navbar />

            <Component {...pageProps} />
          </AuthContext.Provider>
        </>
      )}
    </>
  );
}

export default MyApp;