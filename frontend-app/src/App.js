import "./App.css";
import { BrowserRouter, Route, Routes, Navigate } from "react-router-dom";
import apiService from "./apiService";
import { Studenti } from "./components/Studenti";
import { LoginForma } from "./components/LoginForma";
import { useState } from "react";

function App() {
  const [token, setToken] = useState(apiService.getToken());

  return (
    <BrowserRouter>
      <div className="app container">
        <Routes>
          <Route
            path="/"
            element={
              token ? <Navigate to="/studenti" /> : <Navigate to="/login" />
            }
          ></Route>
          <Route
            path="/login"
            element={<LoginForma updateToken={(token) => setToken(token)} />}
          ></Route>
          <Route path="/logout" element={<Navigate to="/login" />}></Route>
          <Route
            path="/studenti"
            element={token ? <Studenti /> : <Navigate to="/login" />}
          ></Route>
          <Route path="/grupa" element={<h1>grupa</h1>}></Route>
          <Route path="/raspored" element={<h1>raspored</h1>}></Route>
          <Route path="/evidencija" element={<h1>evidencija</h1>}></Route>
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
