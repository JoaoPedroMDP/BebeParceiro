import { maskitoWithPlaceholder } from "@maskito/kit";
import Text, { TextProps } from "./base/text";
import { maskitoChangeEventPlugin, MaskitoOptions } from "@maskito/core";
import { dateValidator } from "../validations/date";

const dateMask: MaskitoOptions = {
    ...maskitoWithPlaceholder('__/__/____'),
    mask: [
        /\d/, /\d/, '/', /\d/, /\d/, '/', /\d/, /\d/, /\d/, /\d/
    ],
    preprocessors: [
        (elementState) => {console.log(elementState); return elementState;}
    ],
    plugins: [
        maskitoChangeEventPlugin()
    ]
};

export default function DateInput(props: Readonly<TextProps>) {
    return (
        <Text {...props} mask={dateMask} validator={dateValidator}/>
    );
}