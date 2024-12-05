import React from "react";



const Navbar = () => {
    return (
        <nav className="navbar navbar-expand px-4 py-3">
            {/* Barre de recherche */}
            <form className="d-none d-sm-inline-block" role="search">
                <div className="d-flex align-items-center">
                    <input 
                        className="form-control me-2" 
                        type="search" 
                        placeholder="Search" 
                        aria-label="Search" 
                    />
                    <button type="button" className="btn btn-dark">
                        <span>Search</span>
                    </button>
                </div>
            </form>
        </nav>
    );
};

export default Navbar;
