import React from "react";
const FormSelect = ({ id, label, value, onChange, options }) => {
    return (
      <div className="col-md-6">
        <label htmlFor={id} className="form-label">{label}</label>
        <select id={id} className="form-select" value={value} onChange={onChange}>
          {options.map((option, index) => (
            <option key={index} value={option}>{option}</option>
          ))}
        </select>
      </div>
    );
  };
  
export default FormSelect;