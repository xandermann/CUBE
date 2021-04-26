import axios from "axios";
import Link from "next/link";
import { useEffect, useState } from "react";

export default function Restaurant() {
  const [restaurants, setRestaurants] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios
      .get(`${process.env.NEXT_PUBLIC_API_URL}/api/restaurants`)
      .then((response) => response.data)
      .then((data) => setRestaurants(data))
      .then(() => setLoading(false))
      .catch(console.error);
  }, []);

  return (
    <>
      <div className="col-md-6 mx-auto">
        <h1>Liste des restaurants</h1>
      </div>

      <div className="col-md-6 mx-auto">
        {loading ? (
          <>Chargement des restaurants...</>
        ) : (
          <code>
            {restaurants.map((r) => (
              <pre key={r.id}>{JSON.stringify(r)}</pre>
            ))}
          </code>
        )}
      </div>

      <hr style={{ marginTop: "100px", marginBottom: "100px" }} />

      <div className="col-md-6 mx-auto">
        <h2>Restaurant 1 (exemple)</h2>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic animi
          odio, harum eaque assumenda, ullam, nihil distinctio alias voluptas
          laudantium exercitationem nam impedit? Labore dolores iure voluptate
          provident quo aspernatur.
        </p>
        <ul className="icon-list">
          <li>
            <Link href="#">
              <a rel="noopener" target="_blank">
                Lien
              </a>
            </Link>
          </li>
        </ul>
      </div>

      <div className="col-md-6 mx-auto">
        <h2>Restaurant 2</h2>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic animi
          odio, harum eaque assumenda, ullam, nihil distinctio alias voluptas
          laudantium exercitationem nam impedit? Labore dolores iure voluptate
          provident quo aspernatur.
        </p>
        <ul className="icon-list">
          <li>
            <Link href="#">
              <a rel="noopener" target="_blank">
                Lien
              </a>
            </Link>
          </li>
        </ul>
      </div>
    </>
  );
}
