import '@testing-library/jest-dom';
import { vi } from 'vitest';
import React from 'react';

global.route = vi.fn((name, params) => {
    return {
        current: (routeName) => routeName === name, // Simula route().current()
        params: params || {}, // Simula os parâmetros da rota
        url: `/${name}${params ? '/' + Object.values(params).join('/') : ''}`,
    };
});

global.window.alert = vi.fn();
global.window.confirm = vi.fn();

vi.mock('@inertiajs/react', async (importOriginal) => {
    const actual = await importOriginal();
    return {
        ...actual,
        usePage: () => ({ 
            props: { 
                flash: { success: 'Success' },
                auth: {user: { id: 1, name: 'John Doe', email: 'john@example.com' }}  
            } }),
        Inertia: {
            visit: vi.fn(),
        },
        Link: ({ href, children }) => <a href={href}>{children}</a>,
        Head: ({ children }) => React.createElement(React.Fragment, {}, children),
        alert: vi.fn(),
          
    }
});