import React, { useContext } from 'react';
import { NavLink } from 'react-router-dom';
import LoginAPI from '../services/LoginAPI';
import loginContext from '../contexts/loginContext';

const Navbar = ({history}) => {

    const {isLogin, setIsLogin } = useContext(loginContext);

    const handleLogout = () => {
        LoginAPI.logout();
        setIsLogin(false);
        history.push('/login')
    }

    return ( 
        <nav className="navbar navbar-expand-lg navbar-dark bg-primary">
            <div className="container-fluid">
                <NavLink className="navbar-brand" to="/" replace>Navbar</NavLink>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="navbarColor01">
                    <ul className="navbar-nav me-auto">
                        <li className="nav-item">
                            <a className="nav-link active" href="#">Home
                                <span className="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="#">Features</a>
                        </li>
                    </ul>
                    <ul className="navbar-nav ml-auto">
                        {!isLogin && <> 
                            <li className="nav-item">
                                <NavLink to="/register" className="nav-link" replace>Inscription</NavLink>
                            </li>
                            <li className="nav-item">
                                <NavLink to="/login" className="nav-link" replace>Connexion</NavLink>
                            </li>
                        </> || <>
                            <li className="nav-item">
                                <button 
                                    onClick={handleLogout}
                                    className="btn btn-secondary">
                                    Deconnexion
                                </button>
                            </li>
                        </>
                        }
                        
                    </ul>
                </div>
            </div>
        </nav>
     );
}
 
export default Navbar;