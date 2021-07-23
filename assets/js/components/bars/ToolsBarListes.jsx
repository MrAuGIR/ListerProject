import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import Field from '../forms/Field';




const ToolsBarListes = ({props}) => {

    const [liste, setListe] = useState({
        title: "",
        description: "",
        color: "#000000",
    })

    const [errors, setErrors] = useState({
        title: "",
        description: "",
        color: ""
    })

    const handleChange = ({currentTarget}) => {
        const {name, value} = currentTarget;
        setListe({...liste, [name]:value});
    }


    const handleSubmit = async (event) => {
        event.preventDefault();
    }


    return ( 
        <>
            <div className="tools-bar-liste">
                <div className="row">
                    <div className="col-12">
                        <h2>Créer une liste</h2>
                    </div>
                    <div className="col-12">
                        <form onSubmit={handleSubmit}>
                            <Field 
                                type="text"
                                name="title"
                                placeholder="Titre de la liste"
                                label="Titre"
                                value={liste.title}
                                error={errors.title}
                                onChange={handleChange}
                            />
                            <Field 
                                type="text"
                                name="description"
                                placeholder="description"
                                label="description"
                                value={liste.description}
                                error={errors.description}
                                onChange={handleChange}
                            />
                            <Field 
                                type="color"
                                name="color"
                                placeholder="#FFFFFF"
                                label="Selection couleur"
                                value={liste.color}
                                error={errors.color}
                                onChange={handleChange}
                            />
                            <div className="form-group mt-3">
                                <button type="submit" className="btn btn-success">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
                

            </div>
        </>
     );
}
 
export default ToolsBarListes;