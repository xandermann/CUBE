import Head from "next/head";

export default function Home() {
  return (
    <>
      <Head>
        <title>Create Next App</title>
        <link rel="icon" href="/favicon.ico" />
      </Head>

      <div className="px-4 py-5 my-5 text-center">
        <img
          className="d-block mx-auto mb-4"
          src="/docs/5.0/assets/brand/bootstrap-logo.svg"
          alt=""
          width="72"
          height="57"
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
    </>
  );
}
