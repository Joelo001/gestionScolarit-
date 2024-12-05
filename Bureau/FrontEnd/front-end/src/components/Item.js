import React from "react";
import { Link } from 'react-router-dom';

// Le composant doit recevoir un objet 'props' qui contient 'to' et 'label'.
const Item = ({ to, label }) => {
    return (
        <li className="list-inline-item">
            <Link to={to} className="text-body-secondary">{label}</Link>
        </li>
    );
};

export default Item;
