import React from "react";
import { Link } from 'react-router-dom';
import Item from "./Item";

const links = [
    { to: "/contact", label: "Contact" },
    { to: "/about", label: "About Us" },
    { to: "/terms", label: "Terms & Conditions" }
];

const Footer = () => (
    <footer className="footer">
        <div className="container-fluid">
            <div className="row text-body-secondary">
                <div className="col-6 text-start">
                    <Link to="/" className="text-body-secondary">
                        <strong>Axi.com</strong>
                    </Link>
                </div>
                <div className="col-6 text-end text-body-secondary d-none d-md-block">
                    <ul className="list-inline mb-0">
                        {links.map((link, index) => (
                            <Item key={index} {...link} />
                        ))}
                    </ul>
                </div>
            </div>
        </div>
    </footer>
);

export default Footer;
