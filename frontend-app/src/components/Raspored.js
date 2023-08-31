import Navigacija from "./Navigacija";
import { useEffect } from "react";
import apiService from "../apiService";

export default function Raspored() {
  useEffect(() => {
    apiService.getRaspored().then((response) => {
      console.log(response.data.data);
    });
  });

  return (
    <div className="container">
      <Navigacija />
      <div>11111</div>
    </div>
  );
}
