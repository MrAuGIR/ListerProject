import React from 'react';

const Pagination = ({currentPage, itemsPerPage, length, onPageChange}) => {

    const pagesCount = Math.ceil(length / itemsPerPage);
    const pages = []

     for (let i = 1; i < pagesCount; i++) {
        console.log(i)
        pages.push(i)
        
    }

    return (         
    <div>
        <ul className="pagination pagination-sm">
            <li className={"page-item"+ (currentPage === 1 && " disabled")}>
            <button 
                className="page-link"
                onClick={() => onPageChange(currentPage - 1)}
                >&laquo;</button>
            </li>
            {pages.map(page => 
                
                <li key={page} className={"page-item" + (currentPage == page && " active")}>
                    <button 
                        onClick={() => onPageChange(page)} 
                        className="page-link">{page}
                    </button>
                </li>
            )}
            <li className={"page-item"+ (currentPage === pagesCount && " disabled")}>
            <button 
                className="page-link"
                onClick={() => onPageChange(currentPage + 1)}>&raquo;
            </button>
            </li>
        </ul>
    </div> 
);
}
 
Pagination.getData = (items, currentPage, itemsPerPage) => {
    //d'ou on part - start
    const start = currentPage * itemsPerPage - itemsPerPage;
    return items.slice(start, start+ itemsPerPage);
}

export default Pagination;