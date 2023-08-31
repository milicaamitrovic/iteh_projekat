import "../Navigacija.css";
import { Link, useLocation } from "react-router-dom";
import apiService from "../apiService";

export default function Navigacija() {
  const location = useLocation();

  return (
    <header>
      <div className="container">
        <ul>
          <li className={location.pathname === "/studenti" ? "active" : ""}>
            <Link to="/studenti">studenti</Link>
          </li>
          <li className={location.pathname === "/grupe" ? "active" : ""}>
            <Link to="/grupe">grupe</Link>
          </li>
          <li className={location.pathname === "/raspored" ? "active" : ""}>
            <Link to="/raspored">raspored</Link>
          </li>
          <li className={location.pathname === "/evidencija" ? "active" : ""}>
            <Link to="/evidencija">evidencija</Link>
          </li>
          <li>
            <Link
              to="/logout"
              onClick={() => {
                apiService.logout();
              }}
            >
              izloguj se
            </Link>
          </li>
        </ul>
      </div>
    </header>
  );
}
