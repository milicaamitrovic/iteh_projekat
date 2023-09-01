import React, { useState } from "react";
import apiService from "../apiService";
import { useNavigate } from "react-router-dom";

export function LoginForma(props) {
    const navigate = useNavigate();
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [error, setError] = useState("");

    function login(event) {
        setError("");
        // prevent default blokira osvezavanje stranice
        event.preventDefault();

        apiService
            .login(email, password)
            .then((response) => {
                setToken(response.data.Token);
                setLoginInfo(response.data.Uloga, response.data.Ime, email);
                props.updateToken(response.data.Token);
                navigate("/");
            })
            .catch((error) => {
                setError(error.response.data.message);
            });
    }

    function setToken(token) {
        apiService.setToken(token);
    }

    function setLoginInfo(uloga, ime, email) {
        apiService.setLoginInfo(uloga, ime, email);
    }

    return (
        <div className="login-forma">
            <div className="login-title">
                <h1>Evidencija prisustva nastavi</h1>
            </div>

            <div className="container">
                <form onSubmit={login}>
                    <div className="input-wrapper">
                        <label>Korisnicko ime</label>
                        <input
                            className="form-input"
                            type="text"
                            value={email}
                            onInput={(event) => {
                                setEmail(event.target.value);
                            }}
                        />
                    </div>

                    <div className="input-wrapper">
                        <label>Lozinka</label>
                        <input
                            className="form-input"
                            type="password"
                            value={password}
                            onInput={(event) => {
                                setPassword(event.target.value);
                            }}
                        />
                    </div>

                    <button type="submit">Prijavi se</button>

                    <div className="poruka">{error}</div>
                </form>
            </div>
        </div>
    );
}
