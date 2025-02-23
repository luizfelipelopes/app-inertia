import Form from "@/Components/Users/Form";
import Pagination from "@/Components/Users/Pagination";
import Table from "@/Components/Users/Table";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm, usePage } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function Users ({ users, user }) {

    const { flash } = usePage().props
    const [show, setShow] = useState(false);
    const [userPage, setUserPage] = useState(user);
    const { delete: destroy , get, reset } = useForm();
    
    const createUser = () => {
        setUserPage(null);
        reset();
        setShow(true);
    }

    const editUser = (id) => {
        get(route('users.show', id));
    }

    const deleteUser = (id) => {

        if(confirm('Are you sure?')) {
            destroy(route('users.destroy', id), {
                onFinish: () => {
                    get(route('users.index'));
                } 
            })
        }
    }

    const sendNotification = (id = null) => {

        if(typeof id === 'number') {
            get(route('users.notification', id), {
                onSuccess: () => {
                    get(route('users.index'));
                }
            });

        } else {
            
            get(route('users.allNotifications'), {
                onSuccess: () => {
                    get(route('users.index'));
                }
            });
        }
    };

    const sendEmail = (id) => {

        if(typeof id === 'number') {
            get(route('users.email', id), {
                onSuccess: () => {
                    get(route('users.index'))
                }
            })
        } else {
            get(route('users.allEmails'), {
                onSuccess: () => {
                    get(route('users.index'))
                }
            })
        }
    };

    useEffect(() => {

        if(flash?.success) {
            alert(flash.success);
        }

    }, [flash])

    
    return (<AuthenticatedLayout header={
        <h2 className="text-xl font-semibold leading-tight text-gray-800">
            Users
        </h2>}>

        <Head title="Users" />

        <div className="w-full flex justify-end pr-20 pt-5">
            <button onClick={sendEmail} className="mr-2 px-3 py-1 bg-yellow-600 text-white rounded">Send All Emails</button>
            <button onClick={sendNotification} className="mr-2 px-3 py-1 bg-blue-500 text-white rounded">Send All Notifications</button>
            <button onClick={createUser} className="mr-2 px-3 py-1 bg-blue-500 text-white rounded">Criar</button>
        </div>

        <div className="w-full flex justify-center my-5 px-20">
            <Table 
                users={users} 
                editUser={editUser} 
                deleteUser={deleteUser} 
                sendNotification={sendNotification}
                sendEmail={sendEmail}/>
        </div>

        {users?.links?.length > 3 && (
            <Pagination testID={'pagination'} links={users?.links} />
        )}

        <Form 
            testID={'form'}
            show={show}
            setShow={setShow}
            user={user} 
            userPage={userPage} 
            />

    </AuthenticatedLayout>);
}