import React, { useContext, useState } from 'react';
import { Link } from 'react-router-dom';
import { toast } from 'react-toastify';
import Field from '../components/forms/Field';
import loginContext from '../contexts/loginContext';
import LoginAPI from '../services/LoginAPI';

const LoginPage = ({history}) => {

    const {setIsLogin} = useContext(loginContext);

    const [credentials, setCredentials] = useState({
        username: "",
        password: ""
    })

    const [errors, setErrors] = useState('');

    //on change on form's field
    const handleChange = ({currentTarget}) => {
        //on destructure currentarget qui est lui même destructuré de event
        const {value, name} = currentTarget;
        // const value = currentTarget.value;
        // const name = currentTarget.name;

        setCredentials({...credentials, [name]:value});
        // [name]: contiendra -> 'username:'  ou  'password:' on fonction que l'on soit sur l'input username ou password
        // value contiendra la valeur du champs dans lequel on tape
    }

    //on submit
    const handleSubmit = async (event) => {
        event.preventDefault();

        try{
            await LoginAPI.login(credentials);
            setErrors("");
            setIsLogin(true);
            toast.success("Vous êtes connecté");
            history.replace("/");
        }catch(error){
            setErrors("Aucun compte ne possède ces identifiants");
            toast.error("une erreur est survenue");
        }
    }

    return (
        <>
            <h2>Connexion</h2>
            <form onSubmit={handleSubmit}>
                <Field 
                    name="username"
                    value={credentials.username}
                    onChange={handleChange}
                    placeholder="Adresse mail de connexion"
                    error={errors}
                />
                <Field 
                    name="password"
                    value={credentials.password}
                    onChange={handleChange}
                    placeholder="Mot de passe"
                    error={errors}
                />
                <div className="form-group">
                    <button type="submit" className="btn btn-success" name="submit">Connexion</button>
                    <Link to="/" className="btn btn-primary">Retour à l'accueil</Link>
                </div>
            </form>
        </>
    );
}

export default LoginPage;