import '../css/styles.css';
import Card from './Card';
import Chart from './Chart';
import Table from './Table';


export default function Dash(){

    return(
    <div className='mt-4'>
        <Card/><Chart/>
    </div>
    )
}