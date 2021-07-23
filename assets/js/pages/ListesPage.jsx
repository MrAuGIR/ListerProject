import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { toast } from 'react-toastify';
import ToolsBarListes from '../components/bars/ToolsBarListes';
import Card from '../components/Card';
import Carousel from '../components/Carousel';
import TableLoader from '../components/loaders/TableLoader';
import Pagination from '../components/Pagination';
import ListesAPI from '../services/ListesAPI';

const ListesPage = (props) => {

    const itemsPerPage = 10;

    const [listes, setListes] =  useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [search, setSearch] = useState('');
    const [loading, setLoading] = useState(true);

    //fetch listes on page loading
    useEffect( () => {
        async function fetchListes(){
            try{
                const data = await ListesAPI.findAll();
                
                setListes(data);
                setLoading(false);
            }catch(error){
                console.log(error);
                toast.error("Erreur lors du chargement de vos listes");
            }
        }
        fetchListes();
    },[]);

    //delete a Liste
    const handleDelete = async id => {
        const originalListes = [...listes];

        setListes(listes.filter(liste => liste.id !== id))

        try{
            await ListesAPI.delete(id);
            toast.success("La liste à bien été supprimée");
        }catch(error){
            setListes(originalListes);
            toast.error("Erreur lors de la suppression");
        }
    }

    //change page
    const handlePageChange = (page) => setCurrentPage(page);

    //filtered data
    const filteredListes = listes.filter( i => 
        
        i.title.toLowerCase().includes(search.toLocaleLowerCase())

    )
    console.log(filteredListes);

    //search input
    const handleSearch = ({currentTarget}) => {
        setSearch(currentTarget.value);
        setCurrentPage(1);
    }

    //paginated data
    const paginatedListes = Pagination.getData(filteredListes,currentPage,itemsPerPage);

    //format date
    const formaDate = (str) => moment(str).format('DD/MM/YYYY');


    return ( <>
        <div className="row">
            <div className="col-3">
                <ToolsBarListes />
            </div>
            <div className="col-9">
                <div className="form-group">
                    <input type="text" className="form-control" onChange={handleSearch} value={search}  placeholder="rechercher .." />
                </div>
                <div className="row">
                {!loading && <>
                    {paginatedListes.map( liste => 
                    <div className="col-12 col-md-6 col-lg-3">
                        <div key={liste.id} className="card">
                            <div className="card-body">
                                <h5 className="card-title">{liste.title}</h5>
                                <p className="card-text">{liste.description}</p>
                                <Link to={"listes/"+ liste.id} className="card-link">Voir</Link>
                                <button onClick={() => handleDelete(liste.id)}  className="btn btn-danger">Suppression</button>
                            </div>
                        </div>
                    </div>
                    )}
                    </>
                }
                </div>
                {loading && <TableLoader />}
                {filteredListes.length > itemsPerPage && 
                    <Pagination 
                        currentPage={currentPage} 
                        itemsPerPage={itemsPerPage} 
                        length={filteredListes.length} 
                        onPageChange={handlePageChange} 
                    />
                }           
            </div>
        </div>
    </> );
}
 
export default ListesPage;