import React from "react";

const Tab = ( {headers, data} ) => {
    return (
            <table className="table table-hover">
                <thead className="table-dark">
                    <tr>
                        {headers.map((header, index) => (
                            <th scope="col" key={index}>
                                {header}
                            </th>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    {data.map((row, index) => (
                        <tr key={index}>
                            {Object.values(row).map((cell, idx) => (
                                <td key={idx}>{cell}</td>
                            ))}
                        </tr>
                    ))}
                </tbody>
            </table>
    );
};

export default Tab;