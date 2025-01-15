
interface ButtonProps{
    label: string;
    clickHandler: (value: boolean) => void;
}

export default function Button(props: Readonly<ButtonProps>) {
    function handleClick(){
        props.clickHandler(true);
    }

    return (
        <div className="m-3 relative w-[100%]">
            <button 
                className="w-[100%] bg-lightGreen text-black p-1 rounded-md border-black border-2 active:bg-darkGreen active:text-white"
                onClick={handleClick}
            >
                {props.label}
            </button>
        </div>
    );
};