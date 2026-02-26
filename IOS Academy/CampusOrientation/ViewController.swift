//
//  ViewController.swift
//  CampusOrientation
//
//  Created by Chiara Paventa on 10/07/2019.
//  Copyright © 2019 Chiara Paventa. All rights reserved.
//

import UIKit
import MapKit
import CoreLocation

class ViewController: UIViewController, MKMapViewDelegate, CLLocationManagerDelegate {
    
    @IBOutlet weak var myMapView: MKMapView!
    
    
    var centralRegion: MKCoordinateRegion!
    let locationManager = CLLocationManager()
    var initialLocation: CLLocationCoordinate2D!
    var centralRect: MKMapRect!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view.
        myMapView.delegate = self
        initialLocation = CLLocationCoordinate2DMake(40.772210, 14.790411)
        centralRegion = MKCoordinateRegion(center: initialLocation, latitudinalMeters: 1000.0, longitudinalMeters: 1000.0)
        centralRect = MKMapRect(origin: MKMapPoint(initialLocation), size: MKMapSize(width: 10000.0, height: 10000.0))
        myMapView.setRegion(centralRegion, animated: true)
        myMapView.mapType = MKMapType.hybrid
        myMapView.isZoomEnabled = true
        myMapView.isPitchEnabled = true
        myMapView.showsCompass = true
        myMapView.showsUserLocation = true

    }

    func mapView(_ mapView: MKMapView, regionDidChangeAnimated animated: Bool)  {
        let center = myMapView.camera.centerCoordinate
        if(!centralRect.contains(MKMapPoint(center))) {
            myMapView.setRegion(centralRegion, animated: true)
        }
    }
    
//    func searchBarTextDidBeginEditing(_ searchBar: UISearchBar) {
//        print("Ho premuto sulla search bar")
////        let secondViewController:TableViewController = TableViewController()
////        self.present(secondViewController, animated: true, completion: nil)
//        performSegue(withIdentifier: "segueMapSearch", sender: nil)
//    }
    
    
}

