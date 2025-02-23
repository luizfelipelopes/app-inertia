export default function Button({ title, bg, ...props}) {
    
    const bgClass = bg ? `bg-${bg}-500` : 'bg-gray-300';
    const textClass = bg ? `text-white` : 'text-gray-800';
    const classes = `px-4 py-2 ${bgClass} ${textClass} rounded`;
    
    return (
        <button {...props} className={classes}>
            {title}
        </button>
    );
}