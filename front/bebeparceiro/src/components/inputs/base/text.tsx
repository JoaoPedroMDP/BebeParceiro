'use client';
import { useState } from "react";
import {type MaskitoOptions} from '@maskito/core';
import {useMaskito} from '@maskito/react';
import { ValidationResult } from "@/app/types";

interface TextProps {
    label: string;
    value: string;
    changeHandler: (value: string) => void;
    validator?: (value: string) => ValidationResult;
    required?: boolean;
    mask?: MaskitoOptions;
    placeholder?: string;
}

export default function Text(props: Readonly<TextProps>) {
    const required = props.required !== undefined;
    const [isValid, setIsValid] = useState<boolean|undefined>(undefined);
    const [errorMessage, setErrorMessage] = useState<string|undefined>(undefined);
    const [showErrorMessage, setShowErrorMessage] = useState<boolean>(false);
    const inputRef = useMaskito({options: props.mask});

    function changeContent(newContent: string) {
        props.changeHandler(newContent);
    }

    function handleChange(event: React.ChangeEvent<HTMLInputElement>) {
        const value = event.target.value;

        if (props.validator) {
            const validation: ValidationResult = props.validator(value);
            setIsValid(validation.isValid);
            setErrorMessage(validation.message);
        }

        changeContent(value);
    }

    function showTip(){
        if(errorMessage){
            setShowErrorMessage(true);
        }
    }

    function hideTip(){
        setShowErrorMessage(false);
    }

    // Defino a cor da borda baseado na validação.
    let borderColor = "border-black";
    // Defino a marca de validade do campo.
    let validityMark = "";
    let validityMarkStyle = "";
    if(isValid === false ) {
        validityMarkStyle = "animate-grow cursor-pointer";
        validityMark = '⚠️';
        borderColor = "border-wrongRed";
    }else if(isValid === true) {
        validityMarkStyle = "text-rightGreen text-xl bg-white";
        validityMark = '✔';
        borderColor = "border-rightGreen";
    }

    // Defino o asterisco de campo obrigatório.
    let requiredMark = required ? "after:content-['*'] after:font-bold after:text-wrongRed" : '';

    return (
        <div className="m-3 relative w-full">
            <span className={`absolute px-1 left-2 -top-2 leading-none touch-pan-down bg-white ${requiredMark}`}>{props.label}</span>
            <div className="flex flex-col">
                <span 
                    hidden={!showErrorMessage || errorMessage === undefined} 
                    className="-top-2 z-10 rounded-lg p-2 absolute text-black font-bold text-[12px] 
                        max-w-[200px] break-words bg-warningYellow"
                >{isValid ? '' : errorMessage}</span>
                <span 
                    onTouchStart={showTip} 
                    onMouseEnter={showTip}
                    onTouchEnd={hideTip}
                    onMouseLeave={hideTip}
                    className={`absolute -left-6 top-2 ${validityMarkStyle}`}
                >{validityMark}</span>
                <input 
                    ref={inputRef}
                    className={`p-2 border-solid border-2 rounded-lg ${borderColor} transition-all duration-100 focus:outline-dashed focus:outline-2 focus:outline-blue-500`} 
                    type="text" 
                    value={props.value} 
                    onInput={handleChange}
                    onChange={(e) => {console.log(e)}}
                    placeholder={props.placeholder}
                    />
            </div>

        </div>
    );
}

export type { TextProps };