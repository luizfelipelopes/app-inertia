import { Link } from "@inertiajs/react";

export default function Pagination({ testID = null, links }) {

    return (
        <div data-testid={testID ?? 'pagination'} id="pag" className="w-full flex justify-center my-5">
            {links?.map((link, index) => (
                <Link 
                    key={index}
                    href={ link.url ? (link.url + '#pag') : '#pag'}
                    className={`px-3 py-1 mx-1 bg-blue-500 text-white rounded ${link.active ? 'bg-blue-700' : ''}`}
                    dangerouslySetInnerHTML={{__html: link.label}}
                />
            ))}
        </div>
    );
}