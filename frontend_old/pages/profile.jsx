import { useRouter } from "next/router";
import { useContext, useEffect } from "react";
import { AuthContext } from "./_app";

export default function Profile() {
  const [auth, setAuth] = useContext(AuthContext);
  const router = useRouter();

  useEffect(() => {
    if (!auth) {
      router.push("/");
    }
  });

  return <h1>Mon profile</h1>;
}
