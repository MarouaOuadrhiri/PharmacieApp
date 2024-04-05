import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';

const Table = () => {
    const [data, setData] = useState([]);
    const [retryCount,setretryCount]=useState(0);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/getAll');
                setData(response.data);
            } catch (error) {
                console.error('AxiosError:', error);
            }
        };

        fetchData();
    },[retryCount]);

    return (
        <div className="card mb-4">
            
            <div className="card-body">
                <ResponsiveContainer width="100%" height={300}>
                    <BarChart
                        data={data}
                        margin={{
                            top: 5,
                            right: 30,
                            left: 20,
                            bottom: 5,
                        }}
                    >
                        <CartesianGrid strokeDasharray="3 3" />
                        <XAxis dataKey="name" />
                        <YAxis />
                        <Tooltip />
                        <Legend />
                        <Bar dataKey="id" name="ID" fill="#8884d8" />
                        <Bar dataKey="category" name="Category" fill="#82ca9d" />
                    </BarChart>
                </ResponsiveContainer>
            </div>
            <div className="card-footer">
                <i className="fas fa-table me-1"></i>
                Diagramme de Répartition des Médicaments par Catégorie
            </div>
        </div>
    );
}

export default Table;
