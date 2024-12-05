import React from "react";
const FormFile =({id,name,label,value,onChange})=>{
    return(
        <div className="col-md-3">
        <label htmlFor={name} className="form-label">{label}</label>
        <input type="file" className="form-control" id={id}  onChange={onChange}/>
      </div>
    );
};
export default FormFile;