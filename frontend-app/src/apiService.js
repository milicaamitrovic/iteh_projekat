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

  getUsers() {
    return axios.get("http://localhost:8000/api/users", {
      headers: {
        Authorization: "Bearer " + this.getToken(),
      },
    });
  }

  updateUser(id, user) {
    return axios.put(`http://localhost:8000/api/users/${id}`, user);
  }

  updateGroup(id, group) {
    return axios.put(`http://localhost:8000/api/grupe/${id}`, group);
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

  logout() {
    return window.sessionStorage.removeItem("token");
  }
}

let apiService = new ApiService();

export default apiService;
