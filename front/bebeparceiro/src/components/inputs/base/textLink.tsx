interface TextLinkProps {
    label: string;
    handleClick: VoidFunction;
}

export default function TextLink(props: Readonly<TextLinkProps>) {
    return (
        <button 
            onClick={props.handleClick} 
            className="hover:underline"
        >
            {props.label}
        </button>
    );

}