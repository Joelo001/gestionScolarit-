import React from "react";
import Sidebar from "../components/Sidebar";
import Main from "../components/Main";
import Footer from "../components/Footer";

const Dashboard = () => {
  return (
    <div className="wrapper">
      <Sidebar />
      <div className="main">
        <Main />
        <Footer />
      </div>
    </div>
  );
};

export default Dashboard;
