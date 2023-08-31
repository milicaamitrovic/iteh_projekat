import axios from "axios";

class ApiService {
  login(email, password) {
    return axios.post("http://localhost:8000/api/login", {
      email: email,
      password: password,
    });
  }

  setToken(token) {
    window.sessionStorage.setItem("token", token);
  }

  getToken() {
    return window.sessionStorage.getItem("token");
  }

  setLoginInfo(uloga, ime) {
    window.sessionStorage.setItem("uloga", uloga);
    window.sessionStorage.setItem("ime", ime);
  }

  getLoginInfo() {
    const uloga = window.sessionStorage.getItem("uloga");
    const ime = window.sessionStorage.getItem("ime");

    return { uloga, ime };
  }

  getUsers() {
    return axios.get("http://localhost:8000/api/users", {
      headers: {
        Authorization: "Bearer " + this.getToken(),
      },
    });
  }

  deleteUser(id) {
    return axios.delete(`http://localhost:8000/api/users/${id}`);
  }

  updateUser(id, user) {
    return axios.put(`http://localhost:8000/api/users/${id}`, user);
  }

  createUser(user) {
    return axios.post(`http://localhost:8000/api/users/`, user);
  }

  createGroup(group) {
    return axios.post(`http://localhost:8000/api/grupe/`, group);
  }

  updateGroup(id, group) {
    return axios.put(`http://localhost:8000/api/grupe/${id}`, group);
  }

  deleteGroup(id) {
    return axios.delete(`http://localhost:8000/api/grupe/${id}`);
  }

  getGrupe() {
    return axios.get("http://localhost:8000/api/grupe", {
      headers: {
        Authorization: "Bearer " + this.getToken(),
      },
    });
  }

  getRaspored() {
    return axios.get("http://localhost:8000/api/rasporedi", {
      headers: {
        Authorization: "Bearer " + this.getToken(),
      },
    });
  }

  deleteRaspored(id) {
    return axios.delete(`http://localhost:8000/api/rasporedi/${id}`);
  }

  getPredmeti() {
    return axios.get("http://localhost:8000/api/predmet", {
      headers: {
        Authorization: "Bearer " + this.getToken(),
      },
    });
  }

  getDani() {
    return axios.get("http://localhost:8000/api/dan", {
      headers: {
        Authorization: "Bearer " + this.getToken(),
      },
    });
  }

  getVreme() {
    return axios.get("http://localhost:8000/api/vreme", {
      headers: {
        Authorization: "Bearer " + this.getToken(),
      },
    });
  }

  updateRaspored(id, raspored) {
    return axios.put(`http://localhost:8000/api/rasporedi/${id}`, raspored);
  }

  createRaspored(raspored) {
    return axios.post(`http://localhost:8000/api/rasporedi/`, raspored);
  }

  createStavku(stavka) {
    return axios.post(`http://localhost:8000/api/stavke/`, stavka);
  }

  getStavkeRasporeda(id) {
    return axios.get(`http://localhost:8000/api/stavkeRasporeda/${id}`, {
      headers: {
        Authorization: "Bearer " + this.getToken(),
      },
    });
  }

  logout() {
    return window.sessionStorage.clear();
  }
}

let apiService = new ApiService();

export default apiService;
