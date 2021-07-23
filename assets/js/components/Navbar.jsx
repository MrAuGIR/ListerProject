import React, { useContext } from 'react';
import { NavLink } from 'react-router-dom';
import LoginAPI from '../services/LoginAPI';
import loginContext from '../contexts/loginContext';
import logo from '../../img/icon/logoList_medium.png';

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
                <NavLink className="navbar-brand" to="/" replace><img src={logo} /></NavLink>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="navbarColor01">
                    <ul className="navbar-nav me-auto">
                        { isLogin && <>
                            <li className="nav-item">
                                <NavLink to="/listes" className="nav-link" replace>Mes listes</NavLink>
                            </li>

                        </> || <>

                        </>

                        }
                        
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