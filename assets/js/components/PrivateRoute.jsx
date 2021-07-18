import React, { useContext } from 'react';
import { Redirect } from 'react-router-dom';
import loginContext from '../contexts/loginContext';

const PrivateRoute = ({path, component}) => {
    const {isLogin} = useContext(loginContext);
    return isLogin ? <Route path={path} component={component} /> : <Redirect to="/login" />;
}
 
export default PrivateRoute;