import React from "react";
const FormField = ({id,name,type="texte",label,value,onChange})=>{
  return (
    <div className="col-md-6">
    <label htmlFor={name} className="form-label">{label}</label>
    <input type={type} className="form-control" id={id} value={value} onChange={onChange}/>
  </div>
  );
};
export default FormField;