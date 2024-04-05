import React from 'react';
import { Link } from "react-router-dom";

const SideBar = () => {
    return (
        <div id="layoutSidenav_nav">
        <nav className="sb-sidenav bg-slate-200 accordion  rounded " id="sidenavAccordion">
            <div className="sb-sidenav-menu">
                <div className="nav">
                    <div className="sb-sidenav-menu-heading">Dashboard Admin</div>
                    <Link className="nav-link text-slate-800 focus:bg-slate-300 hover:bg-slate-300 hover:border-slate-300 rounded" to="/dash">
                        <div className="sb-nav-link-icon"><i className="fas fa-tachometer-alt"></i></div>
                        Admin
                    </Link>
                    <div className="sb-sidenav-menu-heading">Interface</div>
                    <Link className="nav-link collapsed focus:bg-slate-300 hover:bg-slate-300 hover:border-slate-300 rounded" to="/dash/pharmacie" >
                        <div className="sb-nav-link-icon"><i className="fas fa-columns"></i></div>
                        Pharmacie
                    </Link>
                   
                    <Link className="nav-link collapsed focus:bg-slate-300 hover:bg-slate-300 hover:border-slate-300 rounded" to="/dash/users" >
                        <div className="sb-nav-link-icon "><i className="fas fa-book-open"></i></div>
                        Clients
                    </Link>

                    <Link className="nav-link collapsed focus:bg-slate-300 hover:bg-slate-300 hover:border-slate-300 rounded" to="/dash/medicaments" >
                        <div className="sb-nav-link-icon"><i className="fas fa-book-open"></i></div>
                        Medicaments
                    </Link>
                    
                    <div className="sb-sidenav-menu-heading">Addons</div>
                    <Link className="nav-link focus:bg-slate-300 hover:bg-slate-300 hover:border-slate-300 rounded" to="#">
                        <div className="sb-nav-link-icon"><i className="fas fa-chart-area"></i></div>
                        Charts
                    </Link>
                    <Link className="nav-link focus:bg-slate-300 hover:bg-slate-300 hover:border-slate-300 rounded" to="#">
                        <div className="sb-nav-link-icon"><i className="fas fa-table"></i></div>
                        Tables
                    </Link>
                </div>
            </div>
            <div className="sb-sidenav-footer">
                <div className="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>
    );
}

export default SideBar;
