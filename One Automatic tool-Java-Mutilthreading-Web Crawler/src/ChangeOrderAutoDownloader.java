import java.io.*;
import java.util.*;
/**
 * This is an automatic tool which help to Download specific Task Attachment from  
 * @author Roy
 *
 */
public class ChangeOrderAutoDownloader {

	/**
	* The Configuration block of this programme
	*
	*/
	private static String URL = "http://xxxx/CAisd/pdmweb4.exe";
	private static String URL2 = "http://xxxx/GSDChgPlan/jsp/view_implementation_plan.faces";
	private static String SID = "xxxx";
	private static String cookie = "";
	private static String RuntimePath = "C:\\Users\\xxxxx\\Desktop\\RunTime\\"

	/**
	* The Entry point method
	*
	*/
	public static void main(String[] args) throws IOException, InterruptedException {

		HashMap<String, String> map;
		Queue<String> COlist = new LinkedList<String>();
		
		// Get the CO num from the folder
		File listDir = new File(RuntimePath);
		for (int i = 0; i < listDir.listFiles().length; i++) {
			COlist.add(listDir.listFiles()[i].getName());
		}
		while (COlist.size() != 0) {
			String CRNum = COlist.poll();

			//Prepare the content of CO 
			map = DataUtil.preparePara(URL, URL2, cookie, CRNum, SID);
			ChangeOrder temp = new ChangeOrder(CRNum, map.get("PlanID"), 
								map.get("ViewState"),
								map.get("PlanPageHTML"), 
								cookie);
			//Download Task Attachment to RuntimePath
			temp.DownloadZip();
			//Print out the Task Detail
			temp.PrintText();

		}

	}

}
