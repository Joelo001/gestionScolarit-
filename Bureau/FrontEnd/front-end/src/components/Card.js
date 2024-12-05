import React from "react";

const Card = ({title,value,percentage,description})=>{
return (
    <div className="col-3 col-md-4 ">
    <div className="card border-1">
    <div className="card-body py-4">
        <h5 className="mb-2 fw-bold">{title}</h5>
        <p className="mb-2 fw-bold">{value}</p>
        <div className="mb-0">
            <span className="badge text-success me-2">{percentage}</span>
            <span className="fw-bold">{description}</span>
        </div>
    </div>
</div>
</div>
);
}
export default Card;