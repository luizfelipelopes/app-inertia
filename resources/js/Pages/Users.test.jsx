import { render, screen } from '@testing-library/react';
import Users from './Users';
import { expect } from 'vitest';

it('should render users table', () => {

    render(<Users users={ 
        {
            data: [
                {id: 1, name: 'Jamar White', email: 'joe2@example.com'},
                {id: 2, name: 'Wallace Dooley', email: 'joe3@example.com'},
            ]
        } } 
        user={{}} />);

    expect(screen.getByText('Jamar White')).toBeInTheDocument();        
    expect(screen.getByText('Wallace Dooley')).toBeInTheDocument();        

})

it('should render users create button', () => {

    render(<Users users={ 
        {
            data: [
                {id: 1, name: 'Jamar White', email: 'joe2@example.com'},
                {id: 2, name: 'Wallace Dooley', email: 'joe3@example.com'},
            ]
        } } 
        user={{}} />);

    expect(screen.getByText('Criar')).toBeInTheDocument();        

})


it('should render actions users button', () => {

    render(<Users users={
        {
            data: [
                {id: 1, name: 'Jamar White', email: 'joe2@example.com'},
                {id: 2, name: 'Wallace Dooley', email: 'joe3@example.com'},
            ]
        }
        
    } user={{}} />);

    expect(screen.getAllByText('Editar')).toHaveLength(2);
    expect(screen.getAllByText('Deletar')).toHaveLength(2);
    expect(screen.getAllByText('Notification')).toHaveLength(2);
})

it('should render pagination component', () => {

    render(<Users users={
        {
            data: [
                {id: 1, name: 'Jamar White', email: 'joe2@example.com'},
                {id: 2, name: 'Wallace Dooley', email: 'joe3@example.com'},
                {id: 3, name: 'Wallace Dooley', email: 'joe3@example.com'},
                {id: 4, name: 'Wallace Dooley', email: 'joe3@example.com'},
                {id: 5, name: 'Wallace Dooley', email: 'joe3@example.com'},
                {id: 6, name: 'Wallace Dooley', email: 'joe3@example.com'},
                {id: 7, name: 'Wallace Dooley', email: 'joe3@example.com'},
                {id: 8, name: 'Wallace Dooley', email: 'joe3@example.com'},
                {id: 9, name: 'Wallace Dooley', email: 'joe3@example.com'},
                {id: 10, name: 'Wallace Dooley', email: 'joe3@example.com'},
                {id: 11, name: 'Wallace Dooley', email: 'joe3@example.com'},
            ],
            links: [
                {url: 'http://localhost/users?page=1', label: 'Previous', active: true},
                {url: 'http://localhost/users?page=2', label: '1', active: false},
                {url: 'http://localhost/users?page=2', label: '2', active: false},
                {url: 'http://localhost/users?page=2', label: 'Next', active: false},
            ],
        }
        
    } user={{}} />);

    expect(screen.getByTestId('pagination')).toBeInTheDocument();

});

it('should render form component', () => {

    render(<Users users={
        {
            data: [
                {id: 1, name: 'Jamar White', email: 'joe2@example.com'},
                {id: 2, name: 'Wallace Dooley', email: 'joe3@example.com'},
            ]
        }
        
    } user={{}} />);

    expect(screen.getByTestId('form')).toBeInTheDocument();
});

it('should render send all notifications button', () => {

    render(<Users users={{
        data: [
            {id: 1, name: 'Jamar White', email: 'test@mail.com'},
        ]
    }} />);

    expect(screen.getByText('Send All Notifications')).toBeInTheDocument();

})

it('should render send all emails button', () => {
    render(<Users users={{
        data: [
            {id: 1, name: 'Jamar White', email: 'test@mail.com'},
        ]
    }} />);

    expect(screen.getByText('Send All Emails')).toBeInTheDocument();
})

it('should render send email user button', () => {
    render(<Users users={
        {
            data: [
                {id: 1, name: 'Jamar White', email: 'test@mail.com'},
            ]
        }
    } />)

    expect(screen.getByText('Send Email')).toBeInTheDocument();
})