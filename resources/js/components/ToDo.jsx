import React, {useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
function ToDo() {

  const [todoData, setTodoData] = useState([]);
  
    useEffect(() => {
        fetch('https://jsonplaceholder.typicode.com/posts', {
            method: 'get',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
        })
        .then((response) => response.json())
        .then((res) => {
            console.log(res);
            setTodoData(res);
        })
        .catch((error) => {
            console.log(error)
        });
    }, []);

    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">User Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">body</th>
                            </tr>
                        </thead>
                        <tbody>
                            {todoData.map(function(value, index){
                                return(
                                    <tr key={index}>
                                        <th scope="row">{value.id}</th>
                                        <td>{value.userId}</td>
                                        <td>{value.title}</td>
                                        <td>{value.body}</td>
                                    </tr>
                                )
                            })}
                            
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    );
}
export default ToDo;
// DOM element
if (document.getElementById('todo')) {
    ReactDOM.render(<ToDo />, document.getElementById('todo'));
}