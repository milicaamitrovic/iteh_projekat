import "../Navigacija.css";
import { Link, useLocation } from "react-router-dom";
import apiService from "../apiService";

export default function Navigacija() {
    const location = useLocation();
    const korisnik = apiService.getLoginInfo();

    return (
        <header>
            <div className="container">
                <ul>
                    {korisnik.uloga === "administrator" && (
                        <>
                            <li
                                className={
                                    location.pathname === "/studenti"
                                        ? "active"
                                        : ""
                                }
                            >
                                <Link to="/studenti">Studenti</Link>
                            </li>
                            <li
                                className={
                                    location.pathname === "/grupe"
                                        ? "active"
                                        : ""
                                }
                            >
                                <Link to="/grupe">Grupe za nastavu</Link>
                            </li>
                        </>
                    )}

                    <li
                        className={
                            location.pathname === "/raspored" ? "active" : ""
                        }
                    >
                        <Link to="/raspored">Rasporedi nastave</Link>
                    </li>

                    <li
                        className={
                            location.pathname === "/evidencija" ? "active" : ""
                        }
                    >
                        <Link to="/evidencija">Evidencija prisustva</Link>
                    </li>

                    <li>
                        <Link
                            to="/logout"
                            onClick={() => {
                                apiService.logout();
                            }}
                        >
                            Odjavi se
                        </Link>
                    </li>
                </ul>
            </div>
        </header>
    );
}
