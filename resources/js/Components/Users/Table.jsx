export default function Table({ users, editUser, deleteUser, sendNotification, sendEmail }) {
    
    return (
        <div className="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <table className="w-full text-left table-auto min-w-max">
                <thead className="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
                    <tr>
                        <th scope="col" className="p-4 border-b border-blue-gray-100 bg-blue-gray-50 w-96">
                            <p className="block font-sans text-sm antialiased font-extrabold leading-none text-blue-gray-900 opacity-90">
                                Name
                            </p>
                        </th>
                        <th scope="col" className="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                            <p className="block font-sans text-sm antialiased font-extrabold leading-none text-blue-gray-900 opacity-90">
                                Email
                            </p>
                        </th>
                        <th scope="col" className="p-4 border-b border-blue-gray-100 bg-blue-gray-50 w-auto">
                            <p className="block font-sans text-sm antialiased font-extrabold leading-none text-blue-gray-900 opacity-90">
                                Actions
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody className="divide-y divide-outline dark:divide-outline-dark">
                        
                    {users?.data?.map((user) => <tr key={user.id}>
                            <td className="p-4 border-b border-blue-gray-50">
                                <p className="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                { user.name }
                                </p>
                            </td>
                            <td className="p-4 border-b border-blue-gray-50">
                                <p className="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    { user.email }
                                </p>
                            </td>
                            <td className="p-4 border-b border-blue-gray-50">
                                <button onClick={() => editUser(user.id)} className="mr-2 px-3 py-1 bg-indigo-500 text-white rounded">Editar</button>
                                <button onClick={() => deleteUser(user.id)} className="mr-2 px-3 py-1 bg-red-600 text-white rounded">Deletar</button>
                                <button onClick={() => sendNotification(user.id)} className="mr-2 px-3 py-1 bg-cyan-600 text-white rounded">Notification</button>
                                <button onClick={() => sendEmail(user.id)} className="px-3 py-1 bg-yellow-600 text-white rounded">Send Email</button>
                            </td>
                        </tr>)}
                </tbody>
            </table>
        </div>
    );
}