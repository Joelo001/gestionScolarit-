import React, { useState } from 'react';
import { Link } from 'react-router-dom';

// Fonction pour retourner un lien 
const SidebarItem = ({ to, icon, label, children, hasDropdown, targetId }) => (
  <li className="sidebar-item">
    <Link to={to} className={`sidebar-link ${hasDropdown ? 'collapsed' : ''}`} data-bs-toggle={hasDropdown ? 'collapse' : ''} data-bs-target={hasDropdown ? `#${targetId}` : ''} aria-expanded="false" aria-controls={hasDropdown ? targetId : ''}>
      <i className={icon}></i>
      <span>{label}</span>
    </Link>
    {children && children.length > 0 && (
      <ul id={targetId} className="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        {children.map((child, index) => (
          <SidebarItem key={index} {...child} />
        ))}
      </ul>
    )}
  </li>
);

const Sidebar = () => {
  const [isExpanded, setIsExpanded] = useState(true); // Sidebar agrandi par défaut

  const handleToggle = () => {
    setIsExpanded(!isExpanded);
  };

  const tabItem = [
    { to: "/PersonnelAdministratifs", icon: "bi bi-person-vcard-fill", label: "Personnel Administratifs", children: [] },
    { to: "/Enseignant", icon: "bi bi-person-workspace", label: "Enseignant", children: [] },
    {
      to: "#", icon: "bi bi-people-fill", label: "Gestion Elèves", hasDropdown: true, targetId: "auth",
      children: [
        { to: "/students/inscription", label: "Inscription", children: [] },
        { to: "/students/absences", label: "Absences et Notes", children: [] }
      ]
    },
    {
      to: "#", icon: "lni lni-layout", label: "Gestion Etablissement", hasDropdown: true, targetId: "multi",
      children: [
        {
          to: "#", label: "Programmes et Cours", hasDropdown: true, targetId: "multi-two",
          children: [
            { to: "/students/programmes", label: "Programmes", children: [] },
            { to: "/students/cours", label: "Cours", children: [] }
          ]
        }
      ]
    },
    { to: "/notifications", icon: "bi bi-journal-text", label: "Journal", children: [] },
    { to: "/settings", icon: "lni lni-cog", label: "Setting", children: [] }
  ];

  return (
    <aside id="sidebar" className={`sidebar ${isExpanded ? 'expand' : ''}`}>
      <div className="d-flex">
        <button className="toggle-btn" type="button" onClick={handleToggle}>
          <i className="lni lni-grid-alt"></i>
        </button>
        <div className="sidebar-logo">
          <Link to="/acceuil">Axi-Academy</Link>
        </div>
      </div>
      <ul className="sidebar-nav">
        {tabItem.map((item, index) => (
          <SidebarItem key={index} {...item} />
        ))}
      </ul>
      <div className="sidebar-footer">
        <Link to="/" className="sidebar-link">
          <i className="lni lni-exit"></i>
          <span>Logout</span>
        </Link>
      </div>
    </aside>
  );
};

export default Sidebar;
