import { router, useForm } from "@inertiajs/react";
import Modal from "../Modal";
import { useEffect } from "react";
import Input from "./Input";
import Button from "./Button";

export default function Form({ testID, show, setShow, user, userPage}) {

    const { put, post, setData, data, reset } = useForm({
        name: '',
        email: '',
        password: ''
    });

    const handleChange = (e) => {
        setData(e.target.name, e.target.value);
    }
    
    const handleSubmit = (e) => {

        e.preventDefault();

        if(data.id) {
            put(route('users.update', data.id), {
                onSuccess: () => {
                    reset();
                    router.visit(route('users.index'), { replace: true });
                }
            });
            
        } else {
            post('/users', { 
                onSuccess: () => {
                    reset();
                    router.visit(route('users.index'), { replace: true });
                }
            });
        }
    };
    
    const onClose = () => {
        router.visit(route('users.index'), { replace: true });
        setShow(false);
    };

    useEffect(() => {
        if((data && Object.keys(data).length > 0 && Object.values(data)[0].length) || user) {
            setData(user);
            setShow(true);
        }
    }, [user])

    return (
        <Modal show={show} >
            <div className="bg-white p-6 rounded-lg w-full shadow-lg">
                <h2 className="text-xl font-semibold mb-4">{user ? "Edit User" : "Create User"}</h2>
                <form 
                data-testid={testID ?? 'form'}
                onSubmit={handleSubmit} className="space-y-4">
                    <Input
                        type="text"
                        name="name"
                        value={data?.name}
                        onChange={handleChange}
                        placeholder="Name"
                        required
                    />
                    <Input
                        type="email"
                        name="email"
                        value={data?.email}
                        onChange={handleChange}
                        placeholder="Email"
                        required
                    />
                    {!userPage && (
                        <Input
                            type="password"
                            name="password"
                            value={data?.password}
                            onChange={handleChange}
                            placeholder="Password"
                            required
                        />
                    )}
                    <div className="flex justify-end gap-2">
                        <Button title="Cancel" type="button" onClick={onClose} />
                        <Button title="Save" type="submit" bg={'blue'} />
                    </div>
                </form>
            </div>
        </Modal>
    );
}