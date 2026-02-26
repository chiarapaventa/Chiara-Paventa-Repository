//
//  TableViewController.swift
//  CampusOrientation
//
//  Created by Chiara Paventa on 10/07/2019.
//  Copyright © 2019 Chiara Paventa. All rights reserved.
//

import UIKit
import MapKit

struct cellData {
    var opened = Bool()
    var title = String()
    var sectionData = [String]()
}


class TableViewController: UITableViewController, UISearchResultsUpdating {

    @IBOutlet weak var searchBar: UISearchBar!
    
    
    var tableData = [cellData]()
    var buildings = [String]()
    var rooms = [String]()
    var laboratories = [String]()
    var offices = [String]()
    var food = [String]()
    var sport = [String]()
    var transports = [String]()
    var filteredTableData = [String]()
    var selectedElements = [String:[CLLocationCoordinate2D]]()
    var all = [String]()
    var resultSearchController = UISearchController()
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Uncomment the following line to preserve selection between presentations
        // self.clearsSelectionOnViewWillAppear = false
        
        // Uncomment the following line to display an Edit button in the navigation bar for this view controller.
        // self.navigationItem.rightBarButtonItem = self.editButtonItem
        
        buildings = [String](prova.edifici.keys)
        
        all = buildings + rooms + laboratories + offices + food + sport + transports
        print("Numero elementi di tableData: \(all.count) e di buildings \(buildings.count)")
        
        tableData = [cellData(opened: false, title: "Edifici", sectionData: buildings),
                     cellData(opened: false, title: "Studio", sectionData: rooms),
                     cellData(opened: false, title: "Laboratori", sectionData: laboratories),
                     cellData(opened: false, title: "Uffici", sectionData: offices),
                     cellData(opened: false, title: "Ristorazione", sectionData: food),
                     cellData(opened: false, title: "Trasporti", sectionData: sport),
                     cellData(opened: false, title: "Sport", sectionData: transports)]
        
        resultSearchController = ({
            let controller = UISearchController(searchResultsController: nil)
            controller.searchResultsUpdater = self
            controller.dimsBackgroundDuringPresentation = false
            controller.searchBar.sizeToFit()
            tableView.tableHeaderView = controller.searchBar

            return controller
        })()
        // Reload the table
        
//        tableView.reloadData()
    }

    
    // MARK: - Table view data source

    override func numberOfSections(in tableView: UITableView) -> Int {
        // #warning Incomplete implementation, return the number of sections
        if (resultSearchController.isActive  && !searchBarIsEmpty()) {
            return 1
        } else {
            return tableData.count
        }
    }

    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        // #warning Incomplete implementation, return the number of rows
        if  (resultSearchController.isActive  && !searchBarIsEmpty()) {
            return filteredTableData.count
        } else {
            if tableData[section].opened {
                return tableData[section].sectionData.count + 1
            } else {
                return 1
            }
        }
    }
    
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        if (resultSearchController.isActive && !searchBarIsEmpty()) {
            let sectionCell = tableView.dequeueReusableCell(withIdentifier: "sectionCell", for: indexPath) as! SectionCell
            sectionCell.textLabel?.text = filteredTableData[indexPath.row]
            sectionCell.switchObj.text = filteredTableData[indexPath.row]
            sectionCell.switchObj.addTarget(self, action: #selector(toggleSwitch(_:)), for: .valueChanged)
            return sectionCell
        } else {
            if indexPath.row == 0 {
                let titleCell = tableView.dequeueReusableCell(withIdentifier: "titleCell", for: indexPath) as! TitleCell
                titleCell.title?.text = tableData[indexPath.section].title
                return titleCell
            } else {
                let sectionCell = tableView.dequeueReusableCell(withIdentifier: "sectionCell", for: indexPath) as! SectionCell
                let text = "         " + tableData[indexPath.section].sectionData[indexPath.row - 1]
                sectionCell.title?.text = text
                sectionCell.switchObj.text = text
                sectionCell.switchObj.addTarget(self, action: #selector(toggleSwitch(_:)), for: .valueChanged)
                return sectionCell
            }
            
        }
    }
    
    
    @objc func toggleSwitchResearch(_ sender: MySwitch) {
        let key = sender.text
            if prova.edifici[key] != nil {
                selectedElements[key] = prova.edifici[key]
                print("QUESTO E' IL DICTIONARY SELECTED ELEMENTS (NUMERO DI ELEMENTI)")
                print(selectedElements.count)
                print(selectedElements)
            }
    //        if prova.rooms[key] != nil {
    //              selectedElements[key] = prova.aule[key]
    //         }
    //        if prova.laboratories[key] != nil {
    //            selectedElements[key] = prova.laboratories[key]
    //        }
    //        if prova.office[key] != nil {
    //            selectedElements[key] = prova.office[key]
    //        }
    //        if prova.food[key] != nil {
    //            selectedElements[key] = prova.food[key]
    //        }
    //        if prova.sport[key] != nil {
    //            selectedElements[key] = prova.sport[key]
    //        }
    //        if prova.transports[key] != nil {
    //            selectedElements[key] = prova.transports[key]
    //        }
    }
    
    
    @objc func toggleSwitch(_ sender: MySwitch) {
        let key = sender.text
        let value = prova.edifici[key]
        
        if sender.isOn {
            selectedElements[key] = value
            print("QUESTO E' IL DICTIONARY SELECTED ELEMENTS (NUMERO DI ELEMENTI)")
            print(selectedElements.count)
            print(selectedElements)
            //  var value = [CLLocationCoordinate2D]()
            //        print("key: \(key)     value: \(value)")
            //        switch sender.indexSection {
            //        case 0:
            //            value = prova.edifici[key]!
            //            selectedElements[key] = value
            //            print("key: \(key)     value: \(value)")
            //        case 1:
            //                    value = prova.edifici[key]!
            //                    selectedElements[key] = value
            //                    print("key: \(key)     value: \(value)")
            //        case 2:
            //                    value = prova.edifici[key]!
            //                    selectedElements[key] = value
            //                    print("key: \(key)     value: \(value)")
            //        case 3:
            //                    value = prova.edifici[key]!
            //                    selectedElements[key] = value
            //                    print("key: \(key)     value: \(value)")
            //        case 4:
            //                    value = prova.edifici[key]!
            //                    selectedElements[key] = value
            //                    print("key: \(key)     value: \(value)")
            //        case 5:
            //                    value = prova.edifici[key]!
            //                    selectedElements[key] = value
            //                    print("key: \(key)     value: \(value)")
            //        case 6:
            //                    value = prova.edifici[key]!
            //                    selectedElements[key] = value
            //                    print("key: \(key)     value: \(value)")
            //        default: key = ""
            //        }
        } else {
            print("QUESTO E' L'ELEMENTO ELIMINATO (NUMERO DI ELEMENTI)")
            print(selectedElements.count)
            print(selectedElements)
            selectedElements.removeValue(forKey: key)
        }

    }
    
    
    func updateSearchResults(for searchController: UISearchController) {
        filteredTableData.removeAll(keepingCapacity: false)
        let searchPredicate = NSPredicate(format: "SELF CONTAINS[c] %@", searchController.searchBar.text!)
        let array = (all as NSArray).filtered(using: searchPredicate)
        print("Ora ho filtrato")
        filteredTableData = array as! [String]
        self.tableView.reloadData()
    }

    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        print ("hai selezionato riga \(indexPath.row)");
        if indexPath.row == 0 {
            if tableData[indexPath.section].opened {
                tableData[indexPath.section].opened = false
                let sections = IndexSet.init(integer: indexPath.section)
                tableView.reloadSections(sections, with: .none)
            } else {
                tableData[indexPath.section].opened = true
                let sections = IndexSet.init(integer: indexPath.section)
                tableView.reloadSections(sections, with: .none)
            }
        }
    }

    func searchBarIsEmpty() -> Bool {
        // Returns true if the text is empty or nil
        return resultSearchController.searchBar.text?.isEmpty ?? true
    }


    
    //quando viene attivato il segue setta il titolo della View di Cerca in base al nome    //dell'elemento o cercato o selezionato
//    func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject!) {
//        if segue.identifier == "mappaCercaSegue" {
//            let tableViewController = segue.destination as! TableViewController
//            let indexPath = self.tableView.indexPathForSelectedRow()!
//            if self.resultSearchController.isActive {
//                let TitoloDestinazione = self.listaFiltrata[indexPath.row].nome
//                TableViewController.title = TitoloDestinazione
//            } else {
//                let TitoloDestinazione = self.tableData[indexPath.row]
//                TableViewController.title = TitoloDestinazione
//            }
//        }
//    }
    
    /*
    // Override to support conditional editing of the table view.
    override func tableView(_ tableView: UITableView, canEditRowAt indexPath: IndexPath) -> Bool {
        // Return false if you do not want the specified item to be editable.
        return true
    }
    */

    /*
    // Override to support editing the table view.
    override func tableView(_ tableView: UITableView, commit editingStyle: UITableViewCell.EditingStyle, forRowAt indexPath: IndexPath) {
        if editingStyle == .delete {
            // Delete the row from the data source
            tableView.deleteRows(at: [indexPath], with: .fade)
        } else if editingStyle == .insert {
            // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
        }    
    }
    */

    /*
    // Override to support rearranging the table view.
    override func tableView(_ tableView: UITableView, moveRowAt fromIndexPath: IndexPath, to: IndexPath) {

    }
    */

    /*
    // Override to support conditional rearranging of the table view.
    override func tableView(_ tableView: UITableView, canMoveRowAt indexPath: IndexPath) -> Bool {
        // Return false if you do not want the item to be re-orderable.
        return true
    }
    */

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destination.
        // Pass the selected object to the new view controller.
    }
    */

}
