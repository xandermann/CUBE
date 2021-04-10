import Link from "next/link";

export default function Restaurant() {
  return (
    <>
      <div class="col-md-6 mx-auto">
        <h1>Liste des restaurants</h1>
      </div>

      <div class="col-md-6 mx-auto">
        <h2>Restaurant 1</h2>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic animi
          odio, harum eaque assumenda, ullam, nihil distinctio alias voluptas
          laudantium exercitationem nam impedit? Labore dolores iure voluptate
          provident quo aspernatur.
        </p>
        <ul class="icon-list">
          <li>
            <Link href="#">
              <a rel="noopener" target="_blank">
                Lien
              </a>
            </Link>
          </li>
        </ul>
      </div>

      <div class="col-md-6 mx-auto">
        <h2>Restaurant 2</h2>
        <p>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic animi
          odio, harum eaque assumenda, ullam, nihil distinctio alias voluptas
          laudantium exercitationem nam impedit? Labore dolores iure voluptate
          provident quo aspernatur.
        </p>
        <ul class="icon-list">
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
