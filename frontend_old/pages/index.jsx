import Head from "next/head";
import Link from "next/link";
import { useRouter } from "next/router";

export default function Home() {
  const router = useRouter();
  const { defaultLocale, locale } = router;

  // console.log(defaultLocale, locale, router);

  return (
    <>
      <Head>
        <title>Good Food - Restaurants</title>
        <link rel="icon" href="/favicon.ico" />
      </Head>

      <div className="px-4 py-5 my-5 text-center">
        <img
          className="d-block mx-auto mb-4"
          src="/icon.png"
          alt=""
          width="200"
        />
        <h1 className="display-5 fw-bold">Good Food</h1>
        <div className="col-lg-6 mx-auto">
          <p className="lead mb-4">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt,
            necessitatibus. Lorem ipsum dolor sit amet consectetur adipisicing
            elit. Officia, iste veritatis dolore suscipit, eius harum
            repellendus libero, aliquam laborum ea reiciendis? Facilis
            distinctio, officiis voluptates reiciendis adipisci nihil inventore
            vero.
          </p>
          <div className="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <button
              type="button"
              className="btn btn-primary btn-lg px-4 me-sm-3"
            >
              Bouton
            </button>
            <button
              type="button"
              className="btn btn-outline-secondary btn-lg px-4"
            >
              Bouton
            </button>
          </div>
        </div>
      </div>

      <div className="text-center">
        <hr />

        <Link href="/" locale="fr">
          <a>Français</a>
        </Link>
        <Link href="/" locale="en">
          <a>Anglais</a>
        </Link>

        <p>La langue par defaut est {defaultLocale}</p>
        <p>
          La langue choisie est <strong>{locale}</strong>
        </p>
      </div>
    </>
  );
}
