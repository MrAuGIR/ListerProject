import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { toast } from 'react-toastify';
import Field from '../components/forms/Field';
import UsersAPI from '../services/UsersAPI';

const RegisterPage = ({history, match}) => {

    const [user,setUser] = useState({
        firstName: "",
        lastName: "",
        email: "",
        password: "",
        passwordConfirm: ""
    })

    const [errors, setErrors] = useState({
        firstName: "",
        lastName: "",
        email: "",
        password: "",
        passwordConfirm: ""
    })

    //on change input value in form
    const handleChange = ({currentTarget}) => {
        const {name, value} = currentTarget;
        setUser({...user, [name]: value});
    }

    //submit form
    const handleSubmit = async (event) => {
        event.preventDefault();
        console.log(user);
        const apiErrors = {};

        //check password and passwordConfirm
        if(user.password !== user.passwordConfirm){
            apiErrors.passwordConfirm = "Les mots de passe ne sont pas identiques";
            setErrors(apiErrors);
            toast.error("Erreurs lors de la saisie");
            return;
        }

        try{
            await UsersAPI.register(user);
            setErrors({});
            toast.success("Vous êtes désormais inscrit, vous pouvez vous connecter");
            history.replace("/login");
        }catch({response}){
            //errors from api
            const {violations} = response.data;

            if(violations){

                violations.forEach( ({propertyPath, message}) => {
                    apiErrors[propertyPath] = message;
                });
                setErrors(apiErrors);
            }
        }
    }

    return ( 
        <>
            <h2>Inscription</h2>
            <form onSubmit={handleSubmit}>
                <Field
                    name="firstName"
                    label="Prenom"
                    placeholder="Votre Prénom"
                    error={errors.firstName}
                    value={user.firstName}
                    onChange={handleChange}
                />
                <Field
                    name="lastName"
                    label="Nom de famille"
                    placeholder="Votre Nom de famille"
                    error={errors.lastName}
                    value={user.lastName}
                    onChange={handleChange}
                />
                <Field
                    name="email"
                    label="Votre Email"
                    placeholder="Votre email"
                    type="email"
                    error={errors.email}
                    value={user.email}
                    onChange={handleChange}
                />
                <Field
                    name="password"
                    label="Mot de passe"
                    type="password"
                    placeholder="Votre mot de passe"
                    error={errors.password}
                    value={user.password}
                    onChange={handleChange}
                />
                <Field
                    name="passwordConfirm"
                    label="Confirmer mot de passe"
                    type="password"
                    placeholder="Votre mot de passe"
                    error={errors.passwordConfirm}
                    value={user.passwordConfirm}
                    onChange={handleChange}
                />
                <div className="form-group">
                    <button type="submit" className="btn btn-primary">Validation</button>
                    <Link to="/" className="btn btn-primary">Retour à l'accueil</Link>
                </div>
            </form>
        </>
     );
}
 
export default RegisterPage;