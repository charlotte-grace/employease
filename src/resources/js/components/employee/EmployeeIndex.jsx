import React, { useState, useEffect } from 'react';
import axios from 'axios';

const EmployeeIndex = () => {
    const [employees, setEmployees] = useState([]);

    useEffect(() => {
        axios.get('/api/employees').then(response => {
            setEmployees(response.data);
        });
    }, []);

    return (
        <div>
            <h1>Employee Index</h1>
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {employees.map(employee => (
                    <tr key={employee.id}>
                        <td>{employee.name}</td>
                        <td>{employee.email}</td>
                        <td>{employee.phone}</td>
                        <td>{employee.address}</td>
                        <td>
                            <a href={`/employee/${employee.id}/edit`}>Edit</a>
                            <form action={`/employee/${employee.id}`} method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
            <a href="/employee/create">Create Employee</a>
        </div>
    );
};

export default EmployeeIndex;


